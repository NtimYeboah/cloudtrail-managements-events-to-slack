<?php declare(strict_types=1);

namespace App\Composite\Blocks;

use App\Composite\Accessory;

class UsersSelect extends Accessory
{
    protected string $actionId = 'users_select-action';

    protected string $type = 'users_select';

    public function render(): array
    {
        return [
            'text' => $this->fields(),
            'accessory' => $this->accessory(),
        ];
    }
}
