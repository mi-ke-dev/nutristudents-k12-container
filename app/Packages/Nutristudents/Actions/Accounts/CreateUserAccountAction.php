<?php


namespace Bytelaunch\Nutristudents\Actions\Accounts;


use App\Models\User;

class CreateUserAccountAction
{
    private string $firstName;
    private string $lastName;
    private string $password;
    private string $email;

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function create(): User
    {
        $user = User::create([
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'password' => $this->password,
        ]);

        return $user;
    }
}
