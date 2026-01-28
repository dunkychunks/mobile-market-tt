<?php

namespace App\Traits;

use Livewire\Attributes\Locked; // Optional for Livewire 3

trait SweetAlert
{
    /**
     * Dispatch a custom Livewire event to trigger a SweetAlert2 notification.
     *
     * @param string $type The alert type ('success', 'error', 'warning', 'info', 'question').
     * @param string $title The main title of the alert.
     * @param string $text The descriptive text of the alert.
     * @param array $options Optional additional SweetAlert2 configuration options.
     * @return void
     */
    public function showSweetAlert(string $type, string $title, string $text = '', array $options = []): void
    {
        $payload = array_merge([
            'type' => $type,
            'title' => $title,
            'text' => $text,
        ], $options);

        // Dispatch event
        $this->dispatch('swal', $payload);
    }

    /**
     * Success notification.
     */
    public function success(string $title, string $text = '', array $options = []): void
    {
        $this->showSweetAlert('success', $title, $text, $options);
    }

    /**
     * Error notification.
     */
    public function error(string $title, string $text = '', array $options = []): void
    {
        $this->showSweetAlert('error', $title, $text, $options);
    }
}
