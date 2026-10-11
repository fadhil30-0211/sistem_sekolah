<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Models\AssignmentSubmission;

class LmsController extends Controller
{
    // Halaman Publik LMS (Siswa melihat materi)
    public function index()
    {
        $courses = Course::with('guru')->latest()->paginate(9);
        return view('lms.index', compact('courses'));
    }

    // Simpan Materi Baru (Guru)
    public function storeCourse(Request $request)
    {
        $request->validate([
            'mata_pelajaran' => 'required|string',
            'kelas'          => 'required|string',
            'judul_materi'   => 'required|string',
            'deskripsi'      => 'nullable|string',
            'file_materi'    => 'nullable|file|mimes:pdf,docx,pptx,zip|max:10240',
        ]);

        $filePath = $request->file('file_materi')
            ? $request->file('file_materi')->store('materi', 'public')
            : null;

        Course::create([
            'mata_pelajaran' => $request->mata_pelajaran,
            'kelas'          => $request->kelas,
            'judul_materi'   => $request->judul_materi,
            'deskripsi'      => $request->deskripsi,
            'file_materi'    => $filePath,
            'guru_id'        => auth()->id(),
        ]);

        return back()->with('success', 'Materi pembelajaran berhasil ditambahkan.');
    }

    // Guru membuat tugas baru
    public function storeAssignment(Request $request)
    {
        $request->validate([
            'course_id'     => 'required|exists:courses,id',
            'judul_tugas'   => 'required|string',
            'instruksi'     => 'required|string',
            'tenggat_waktu' => 'required|date',
            'file_tugas'    => 'nullable|file|mimes:pdf,docx,zip|max:10240',
        ]);

        $filePath = $request->file('file_tugas')
            ? $request->file('file_tugas')->store('tugas', 'public')
            : null;

        Assignment::create([
            'course_id'     => $request->course_id,
            'judul_tugas'   => $request->judul_tugas,
            'instruksi'     => $request->instruksi,
            'tenggat_waktu' => $request->tenggat_waktu,
            'file_tugas'    => $filePath,
        ]);

        return back()->with('success', 'Tugas berhasil dipublikasikan ke siswa.');
    }

    // Siswa mengunggah jawaban tugas
    public function submitAssignment(Request $request, $assignment_id)
    {
        $request->validate([
            'nama_siswa'   => 'required|string|max:255',
            'kelas_siswa'  => 'required|string|max:50',
            'file_jawaban' => 'required|file|mimes:pdf,docx,zip,jpg,png|max:10240',
            'catatan_siswa'=> 'nullable|string',
        ]);

        $filePath = $request->file('file_jawaban')->store('submissions', 'public');

        AssignmentSubmission::create([
            'assignment_id' => $assignment_id,
            'nama_siswa'    => $request->nama_siswa,
            'kelas_siswa'   => $request->kelas_siswa,
            'file_jawaban'  => $filePath,
            'catatan_siswa' => $request->catatan_siswa,
        ]);

        return back()->with('success', 'Jawaban tugas Anda berhasil dikirim ke guru.');
    }

    // Guru memberikan nilai dan catatan pada tugas siswa
    public function gradeAssignment(Request $request, $id)
    {
        $request->validate([
            'nilai'        => 'required|integer|min:0|max:100',
            'catatan_guru' => 'nullable|string',
        ]);

        $submission = AssignmentSubmission::findOrFail($id);
        $submission->update([
            'nilai'        => $request->nilai,
            'catatan_guru' => $request->catatan_guru,
        ]);

        return back()->with('success', "Nilai untuk tugas {$submission->nama_siswa} berhasil disimpan.");
    }
}
