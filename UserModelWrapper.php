<?php
namespace Neoan3\Model\User;

use Neoan3\Provider\Model\ModelWrapper;
use Neoan3\Provider\Model\ModelWrapperTrait;

class UserModelWrapper extends UserModel implements ModelWrapper
{
	use ModelWrapperTrait;

	private ?string $id;
	private ?string $insert_date;
	private ?string $delete_date = null;
	private string $email;
	private string $password;

	public function getId(): mixed
	{
		return $this->id;
	}

	public function setId($input): static
	{
		$this->id = $input;
		return $this;
	}

	public function getInsertDate(): mixed
	{
		return $this->insert_date;
	}

	public function setInsertDate($input): static
	{
		$this->insert_date = $input;
		return $this;
	}

	public function getDeleteDate(): mixed
	{
		return $this->delete_date;
	}

	public function setDeleteDate($input): static
	{
		$this->delete_date = $input;
		return $this;
	}

	public function getEmail(): mixed
	{
		return $this->email;
	}

	public function setEmail($input): static
	{
		$this->email = $input;
		return $this;
	}

	public function getPassword(): mixed
	{
		return $this->password;
	}

	public function setPassword($input): static
	{
		$this->password = $input;
		return $this;
	}

}
