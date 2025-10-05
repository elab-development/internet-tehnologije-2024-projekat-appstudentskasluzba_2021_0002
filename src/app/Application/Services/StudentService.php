<?php

namespace App\Application\Services;

use App\Application\Models\Student;
use App\Application\Repositories\StudentRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Validation\ValidationException;

class StudentService
{
    public function __construct(
        private readonly StudentRepositoryInterface $repo
    ) {}

    public function getStudents(?int $perPage = 10, ?string $q = null): LengthAwarePaginator
    {
        return $this->repo->paginateWithFilters($perPage, $q);
    }

    public function getStudentById(int $id): Student
    {
        return $this->repo->findById($id);
    }

    public function createStudent(array $data): Student
    {
        $ime = trim((string)($data['ime'] ?? ''));
        $prezime = trim((string)($data['prezime'] ?? ''));
        $godinaStudija = (int)($data['godina'] ?? 1);

        $this->validateName($ime, 'ime');
        $this->validateName($prezime, 'prezime');
        $this->validateGodinaStudija($godinaStudija);

        $now = now();
        $enrollmentYear = $now->month < 10 ? $now->year - 1 : $now->year;

        if ($enrollmentYear < 2015 || $enrollmentYear > 2025) {
            throw ValidationException::withMessages([
                'broj_indeksa' => "Godina upisa ({$enrollmentYear}) mora biti između 2015 i 2025.",
            ]);
        }

        $nextSuffix = $this->repo->getNextIndexSuffixForYear($enrollmentYear);
        $serial4   = str_pad((string)$nextSuffix, 4, '0', STR_PAD_LEFT);
        $brojIndeksa = "{$enrollmentYear}{$serial4}";

        $email = $this->napraviMail($ime, $prezime, $brojIndeksa);

        $payload = [
            'ime'          => $ime,
            'prezime'      => $prezime,
            'godina'       => $godinaStudija,
            'broj_indeksa' => $brojIndeksa,
            'email'        => $email,
        ];

        return $this->repo->create($payload);
    }

    public function updateStudent(Student $student, array $data): Student
    {
        $allowed = ['ime', 'prezime', 'godina'];
        $data = array_intersect_key($data, array_flip($allowed));

        if (array_key_exists('ime', $data)) {
            $this->validateName($data['ime'], 'ime');
        }
        if (array_key_exists('prezime', $data)) {
            $this->validateName($data['prezime'], 'prezime');
        }
        if (array_key_exists('godina', $data)) {
            $this->validateGodinaStudija((int)$data['godina']);
        }

        $novoIme     = array_key_exists('ime', $data) ? $data['ime'] : $student->ime;
        $novoPrezime = array_key_exists('prezime', $data) ? $data['prezime'] : $student->prezime;
        $data['email'] = $this->napraviMail($novoIme, $novoPrezime, $student->brojIndeksa);

        return $this->repo->update($student, $data);
    }

    public function deleteStudent(Student $student): void
    {
        $this->repo->delete($student);
    }

    private function validateName(string $value, string $field): void
    {
        if ($value === '') {
            throw ValidationException::withMessages([$field => ucfirst($field).' je obavezno polje.']);
        }
        if (mb_strlen($value) > 30) {
            throw ValidationException::withMessages([$field => ucfirst($field).' ne može imati više od 30 karaktera.']);
        }
    }

    private function validateGodinaStudija(int $g): void
    {
        if ($g < 1 || $g > 4) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'godina' => 'Godina studija mora biti u opsegu 1–4.',
            ]);
        }
    }

    private function napraviMail(string $ime, string $prezime, string $brojIndeksa): string
    {
        $inicijali = strtolower(substr($ime, 0, 1) . substr($prezime, 0, 1));

        $email = $inicijali . $brojIndeksa . '@student.fon.bg.ac.rs';

        return $email;
    }

}
