<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\ClassroomResource;
use App\Models\Classroom;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        $classrooms = Classroom::with(['owner', 'flashcardFolders'])->get();

        return ClassroomResource::collection($classrooms);
    }
}
