<?php


namespace Bytelaunch\Nutristudents\Actions\Accounts;


use App\Models\User;

class UpdateUserAccountAction
{
    private User $user;

    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

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

    public function update(): User
    {
        $input = [];
        if(isset($this->email))
            $input['email'] = $this->email;
        if(isset($this->firstName))
            $input['first_name'] = $this->firstName;
        if(isset($this->lastName))
            $input['last_name'] = $this->lastName;
        if(count($input) > 0)
            $this->user->update($input);
        return $this->user;
    }
}
