<?php

namespace App\Traits;

trait ToastMagic
{
    /**
     * Dispatches a Livewire event to trigger a ToastMagic notification.
     *
     * @param string $type The toast type ('success', 'error', 'warning', 'info').
     * @param string $title The main title of the toast.
     * @param string $message The descriptive message of the toast.
     * @param array $options Optional additional ToastMagic configuration options.
     * @return void
     */
    public function showToast(string $type, string $title, string $message, array $options = []): void
    {
        $this->dispatch(
            'toastMagic',
            status: $type,
            title: $title,
            message: $message,
            options: $options
        );
    }

    /**
     * Success notification.
     */
    public function toastSuccess(string $title, string $message = '', array $options = []): void
    {
        $this->showToast('success', $title, $message, $options);
    }

    /**
     * Error notification.
     */
    public function toastError(string $title, string $message = '', array $options = []): void
    {
        $this->showToast('error', $title, $message, $options);
    }

    /**
     * Warning notification.
     */
    public function toastWarning(string $title, string $message = '', array $options = []): void
    {
        $this->showToast('warning', $title, $message, $options);
    }
}
