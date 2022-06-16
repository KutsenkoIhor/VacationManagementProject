<?php

declare(strict_types=1);

namespace App\Services\Vacation;

use App\DTO\UserDTO;
use App\Events\ApproveVacationRequestEvent;
use App\Repositories\Interfaces\UserRepositoryInterface;

class BypassApprovalService
{
    private UserRepositoryInterface $interface;

    public function __construct(UserRepositoryInterface $interface)
    {
        $this->interface = $interface;
    }

    public function bypassApproveVacationRequest(int $vacationRequestId, UserDTO $user): void
    {
        if ($this->interface->hasAnyRole($user->getId(), config('approval_rule.approval_rule'))) {
            event(new ApproveVacationRequestEvent($vacationRequestId));
        }
    }
}
