<?php

namespace App\Presentation\Http\Controllers;

use App\Application\Models\Predmet;
use App\Application\Services\PredmetService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PredmetController extends Controller
{
    private PredmetService $predmetService;

    public function __construct(PredmetService $predmetService)
    {
        $this->predmetService = $predmetService;
    }

    public function index(Request $request): JsonResponse
    {
        $predmeti = $this->predmetService->getAll(
            $request->query('per_page', 10),
            $request->query('semestar'),
            $request->query('espb_min')
        );

        return response()->json($predmeti);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'ime' => 'required|string|max:255',
            'espb' => 'required|integer|min:1',
            'katedra' => 'required|string|max:255',
            'broj_studenata' => 'required|integer|min:0',
            'profesor' => 'required|string|max:255',
        ]);

        $predmet = $this->predmetService->create($validated);
        return response()->json($predmet, 201);
    }

    public function show(int $id): JsonResponse
    {
        $predmet = $this->predmetService->find($id);
        return response()->json($predmet);
    }

    public function update(Request $request, Predmet $predmet): JsonResponse
    {
        $validated = $request->validate([
            'ime' => 'string|max:255',
            'espb' => 'integer|min:1',
            'katedra' => 'string|max:255',
            'broj_studenata' => 'integer|min:0',
            'profesor' => 'string|max:255',
        ]);

        $updated = $this->predmetService->update($predmet, $validated);
        return response()->json($updated);
    }

    public function destroy(Predmet $predmet): JsonResponse
    {
        $this->predmetService->delete($predmet);
        return response()->json(null, 204);
    }
}
