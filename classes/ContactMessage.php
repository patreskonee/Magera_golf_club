<?php

declare(strict_types=1);

final class ContactMessage
{
    public function __construct(private PDO $db)
    {
    }

    public function all(): array
    {
        $statement = $this->db->query('SELECT * FROM contact_messages ORDER BY created_at DESC');
        return $statement->fetchAll();
    }

    public function create(array $data): void
    {
        $statement = $this->db->prepare(
            'INSERT INTO contact_messages (full_name, email, message)
             VALUES (:full_name, :email, :message)'
        );
        $statement->execute([
            'full_name' => trim((string) $data['full-name']),
            'email' => trim((string) $data['email']),
            'message' => trim((string) $data['message']),
        ]);
    }

    public function validate(array $data): array
    {
        $errors = [];

        if (trim((string) ($data['full-name'] ?? '')) === '') {
            $errors[] = 'Meno je povinne.';
        }

        if (!filter_var((string) ($data['email'] ?? ''), FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email nie je v spravnom formate.';
        }

        if (trim((string) ($data['message'] ?? '')) === '') {
            $errors[] = 'Sprava je povinna.';
        }

        return $errors;
    }
}
