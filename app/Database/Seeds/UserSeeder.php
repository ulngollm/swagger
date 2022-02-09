<?php


use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */

    public function run()
    {
        $faker = Faker\Factory::create();
        $data = [];
        for ($i = 0; $i < 20; $i++) {
            $data[] = [
                'login' => $faker->userName,
                'password' => password_hash($faker->password, PASSWORD_BCRYPT)
            ];
        }

        $users = $this->table('users');
        $users->insert($data)->saveData();
    }
}
