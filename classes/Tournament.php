<?php

declare(strict_types=1);

final class Tournament
{
    public function __construct(private PDO $db)
    {
    }

    public function all(): array
    {
        $statement = $this->db->query('SELECT * FROM tournaments ORDER BY tournament_date ASC, id DESC');
        return $statement->fetchAll();
    }

    public function upcoming(int $limit = 3): array
    {
        $statement = $this->db->prepare('SELECT * FROM tournaments WHERE tournament_date >= CURDATE() ORDER BY tournament_date ASC LIMIT :limit');
        $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function find(int $id): ?array
    {
        $statement = $this->db->prepare('SELECT * FROM tournaments WHERE id = :id');
        $statement->execute(['id' => $id]);
        $tournament = $statement->fetch();

        return $tournament ?: null;
    }

    public function create(array $data): int
    {
        $statement = $this->db->prepare(
            'INSERT INTO tournaments (title, tournament_date, location, description, max_players, entry_fee, status, image_path)
             VALUES (:title, :tournament_date, :location, :description, :max_players, :entry_fee, :status, :image_path)'
        );
        $statement->execute($this->normalize($data));

        return (int) $this->db->lastInsertId();
    }

    public function update(int $id, array $data): void
    {
        $values = $this->normalize($data);
        $values['id'] = $id;

        $statement = $this->db->prepare(
            'UPDATE tournaments
             SET title = :title,
                 tournament_date = :tournament_date,
                 location = :location,
                 description = :description,
                 max_players = :max_players,
                 entry_fee = :entry_fee,
                 status = :status,
                 image_path = :image_path
             WHERE id = :id'
        );
        $statement->execute($values);
    }

    public function delete(int $id): void
    {
        $statement = $this->db->prepare('DELETE FROM tournaments WHERE id = :id');
        $statement->execute(['id' => $id]);
    }

    public function validate(array $data): array
    {
        $errors = [];

        if (trim((string) ($data['title'] ?? '')) === '') {
            $errors[] = 'Nazov turnaja je povinny.';
        }

        if (trim((string) ($data['tournament_date'] ?? '')) === '') {
            $errors[] = 'Datum turnaja je povinny.';
        }

        if (trim((string) ($data['location'] ?? '')) === '') {
            $errors[] = 'Miesto turnaja je povinne.';
        }

        return $errors;
    }

    private function normalize(array $data): array
    {
        return [
            'title' => trim((string) $data['title']),
            'tournament_date' => (string) $data['tournament_date'],
            'location' => trim((string) $data['location']),
            'description' => trim((string) ($data['description'] ?? '')),
            'max_players' => ($data['max_players'] ?? '') !== '' ? (int) $data['max_players'] : null,
            'entry_fee' => ($data['entry_fee'] ?? '') !== '' ? (float) $data['entry_fee'] : null,
            'status' => (string) ($data['status'] ?? 'planned'),
            'image_path' => trim((string) ($data['image_path'] ?? 'images/professional-golf-player.jpg')),
        ];
    }
}
