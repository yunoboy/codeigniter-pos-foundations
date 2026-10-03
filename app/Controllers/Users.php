<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    public function index(): string
    {
        $userModel = new UserModel();

        $users = $userModel
            ->orderBy('id', 'ASC')
            ->findAll();

        return view('users/index', [
            'users' => $users,
            'success' => session()->getFlashdata('success'),
        ]);
    }

    public function new(): string
    {
        return view('users/form', [
            'title' => 'New User',
            'action' => site_url('users'),
            'submitLabel' => 'Create User',
            'user' => [
                'username' => '',
                'full_name' => '',
                'avatar' => null,
            ],
            'errors' => [],
            'allowAvatar' => false,
        ]);
    }

    public function create()
    {
        $user = $this->userInput();
        $rules = [
            'username' => 'required|max_length[50]|is_unique[users.username]',
            'full_name' => 'required|max_length[100]',
        ];

        if (! $this->validateData($user, $rules)) {
            return view('users/form', [
                'title' => 'New User',
                'action' => site_url('users'),
                'submitLabel' => 'Create User',
                'user' => array_merge($user, ['avatar' => null]),
                'errors' => $this->validator->getErrors(),
                'allowAvatar' => false,
            ]);
        }

        $user['created_at'] = date('Y-m-d H:i:s');
        (new UserModel())->insert($user);

        return redirect()->to(site_url('users'))
            ->with('success', 'User account created successfully. You can now edit it to add an avatar.');
    }

    public function edit(int $id): string
    {
        $user = (new UserModel())->find($id);

        if ($user === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('User not found.');
        }

        return view('users/form', [
            'title' => 'Edit User',
            'action' => site_url('users/' . $id),
            'submitLabel' => 'Update User',
            'user' => $user,
            'errors' => [],
            'allowAvatar' => true,
        ]);
    }

    public function update(int $id)
    {
        $userModel = new UserModel();
        $existing = $userModel->find($id);

        if ($existing === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('User not found.');
        }

        $user = $this->userInput();
        $rules = [
            'username' => 'required|max_length[50]|is_unique[users.username,id,' . $id . ']',
            'full_name' => 'required|max_length[100]',
        ];

        if (! $this->validateData($user, $rules)) {
            return $this->userEditForm($id, $existing, $user, $this->validator->getErrors());
        }

        $avatar = $this->request->getFile('avatar');

        if ($avatar !== null && $avatar->getError() !== UPLOAD_ERR_NO_FILE) {
            $avatarRules = [
                'avatar' => [
                    'label' => 'Profile picture',
                    'rules' => 'uploaded[avatar]|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png]|max_size[avatar,2048]',
                    'errors' => [
                        'uploaded' => 'Choose a JPG or PNG image to upload.',
                        'is_image' => 'The selected file must be an image.',
                        'mime_in' => 'The profile picture must be a JPG or PNG file.',
                        'max_size' => 'The profile picture must not exceed 2 MB.',
                    ],
                ],
            ];

            if (! $this->validateData([], $avatarRules)) {
                return $this->userEditForm($id, $existing, $user, $this->validator->getErrors());
            }

            $user['avatar'] = $this->prepareAvatar($avatar);
        }

        $userModel->update($id, $user);

        return redirect()->to(site_url('users'))
            ->with('success', 'User account updated successfully.');
    }

    private function userInput(): array
    {
        return [
            'username' => trim((string) $this->request->getPost('username')),
            'full_name' => trim((string) $this->request->getPost('full_name')),
        ];
    }

    private function userEditForm(int $id, array $existing, array $input, array $errors): string
    {
        return view('users/form', [
            'title' => 'Edit User',
            'action' => site_url('users/' . $id),
            'submitLabel' => 'Update User',
            'user' => array_merge($existing, $input),
            'errors' => $errors,
            'allowAvatar' => true,
        ]);
    }

    private function prepareAvatar(\CodeIgniter\HTTP\Files\UploadedFile $avatar): string
    {
        $uploadPath = FCPATH . 'uploads' . DIRECTORY_SEPARATOR . 'avatars';

        if (! is_dir($uploadPath) && ! mkdir($uploadPath, 0755, true) && ! is_dir($uploadPath)) {
            throw new \RuntimeException('Unable to create the avatar upload directory.');
        }

        $extension = strtolower((string) $avatar->guessExtension());
        $filename = bin2hex(random_bytes(16)) . '.' . $extension;
        $destination = $uploadPath . DIRECTORY_SEPARATOR . $filename;

        service('image')
            ->withFile($avatar->getTempName())
            ->fit(300, 300, 'center')
            ->save($destination, 85);

        return $filename;
    }
}
