<?php


class UserService
{
    public static function findExistsUser(string $login): ?User
    {
        $user = User::where('login', $login)->first();
        return $user ?? null;
    }

    public static function validatePassword(User $user, string $inputPassword)
    {
        $password = $user->getPassword();
        return password_verify($inputPassword, $password);
    }

    public static function addUser(string $login, string $password, int $roleId = 1)
    {
        $user = new User([
            'login' => $login,
            'password' => password_hash($password, PASSWORD_BCRYPT)
        ]);
        $role = Role::find($roleId);
        $role->users()->save($user);
        $user->save();
    }
}