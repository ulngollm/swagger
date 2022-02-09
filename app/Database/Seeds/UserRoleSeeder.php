<?php


use Phinx\Seed\AbstractSeed;

class UserRoleSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function getDependencies()
    {
        return [
            'UserSeeder',
            'RoleSeeder'
        ];
    }

    public function run()
    {
        $maxUserId = 20;
        $maxRoleId = 5;
        $data = [];

        for ($i = 0; $i < 30; $i++) {
            $userId = rand(1, $maxUserId);
            $roleId = rand(1, $maxRoleId);
            $data[] = [
                'role_id' => $roleId,
                'user_id' => $userId
            ];
        }

        $userRoles = $this->table('role_user');
        $userRoles->insert($data)->saveData();
    }
}
