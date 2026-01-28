<?php

namespace App\Traits;

use Flasher\Notyf\Prime\NotyfFactory;

trait PhpFlasher
{
    /**
     * Applies default Notyf settings and returns the Notyf instance.
     *
     */
    private function default()
    {
        return notyf()
            ->position('x', 'right')
            ->position('y', 'top')
            ->duration(10000) // 10 seconds
            ->ripple(true)
            ->dismissible(true);
    }


    /**
     * Shows a success notification.
     */
    public function flashSuccess(string $message): void
    {
        $this->default()->addSuccess($message);
    }

    /**
     * Shows an error notification.
     */
    public function flashError(string $message): void
    {
        $this->default()->addError($message);
    }

    /**
     * Shows a warning notification.
     */
    public function flashWarning(string $message): void
    {
        $this->default()->addWarning($message);
    }

    /**
     * Shows an info notification.
     */
    public function flashInfo(string $message): void
    {
        $this->default()->addInfo($message);
    }
}
