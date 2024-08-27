<?php

declare(strict_types=1);

/**
 * User
 *
 * A user of the system
 */
class User
{

    /**
     * First name
     * @var string
     */
    public string $first_name = "";
    
    /**
     * Last name
     * @var string
     */
    public string $surname = "";

    public string $email = "";

    protected Mailer $mailer;

    /**
     * Get the user's full name from their first name and surname
     *
     * @return string The user's full name
     */
    public function getFullName(): string
    {
        return trim("$this->first_name $this->surname");
    }

    public function notify($message): bool 
    {
        return $this->mailer->sendMessage($this->email, $message);
    }

    public function setMailer(Mailer $mailer): void 
    {
        $this->mailer = $mailer;
    }
}