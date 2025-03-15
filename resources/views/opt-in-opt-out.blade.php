@extends('welcome')

@section('content')
<div class="container mx-auto mt-5">
    <!-- Add Student Time Button -->
    <div class="flex justify-end">
        <button id="openModal" 
            data-action="{{ route('student_time.store') }}" 
            class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
            Add Student Time
        </button>
    </div>

    <!-- Student Training Schedule Table -->
    <div class="flex justify-end mt-4">
        <div class="w-3/4">
            <table class="table-auto w-full shadow-lg rounded-lg">
                <thead>
                    <tr class="bg-gray-200 text-left text-sm">
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Student</th>
                        <th class="px-4 py-3">Training</th>
                        <th class="px-4 py-3">Opt-in Time</th>
                        <th class="px-4 py-3">Opt-out Time</th>
                        <th class="px-4 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($schedules as $schedule)
                    <tr class="bg-white hover:bg-gray-100 transition border-b">
                        <td class="px-4 py-3">{{ $schedule->id }}</td>
                        <td class="px-4 py-3">{{ $schedule->student->name }}</td>
                        <td class="px-4 py-3">{{ $schedule->trainingSchedule->course->name }}</td>
                        <td class="px-4 py-3">{{ $schedule->opt_in_at }}</td>
                        <td class="px-4 py-3">{{ $schedule->opt_out_at }}</td>
                        <td class="px-4 py-3 flex justify-center space-x-2">
                            <!-- Edit Button -->
                            <button class="editSchedule bg-yellow-500 text-white px-3 py-1 rounded"
                                data-id="{{ $schedule->id }}" 
                                data-student_id="{{ $schedule->student_id }}"
                                data-training_id="{{ $schedule->training_id }}"
                                data-opt_in_at="{{ $schedule->opt_in_at }}"
                                data-opt_out_at="{{ $schedule->opt_out_at }}"
                                data-action="{{ route('student_time.update', $schedule->id) }}">
                                Edit
                            </button>

                            <!-- Delete Button -->
                            <form action="{{ route('student_time.destroy', $schedule->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded"
                                    onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add/Edit Training Schedule Modal -->
    <div id="trainingModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <div class="flex justify-between items-center">
                <h3 id="modalTitle" class="text-lg font-semibold">Add Training Schedule</h3>
                <button id="closeModal" class="text-gray-500 hover:text-gray-700">&times;</button>
            </div>

            <form id="trainingForm" action="{{ route('student_time.store') }}" method="POST">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <input type="hidden" name="id" id="schedule_id">

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Student</label>
                    <select name="student_id" id="student_id" class="w-full border p-2 rounded-lg">
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Training</label>
                    <select name="training_id" id="training_id" class="w-full border p-2 rounded-lg">
                        @foreach ($trainings as $training)
                            <option value="{{ $training->id }}">{{ $training->course->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Opt-in Time</label>
                    <input type="time" name="opt_in_at" id="opt_in_at" class="w-full border p-2 rounded-lg">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Opt-out Time</label>
                    <input type="time" name="opt_out_at" id="opt_out_at" class="w-full border p-2 rounded-lg">
                </div>

                <div class="flex justify-end space-x-2">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Save Schedule</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const modal = document.getElementById('trainingModal');
    const modalTitle = document.getElementById('modalTitle');
    const trainingForm = document.getElementById('trainingForm');
    const formMethod = document.getElementById('formMethod');
    const scheduleId = document.getElementById('schedule_id');
    const studentId = document.getElementById('student_id');
    const trainingId = document.getElementById('training_id');
    const optInAt = document.getElementById('opt_in_at');
    const optOutAt = document.getElementById('opt_out_at');
    const closeModal = document.getElementById('closeModal');
    const openModalButton = document.getElementById('openModal');
    const editButtons = document.querySelectorAll('.editSchedule');

    openModalButton.addEventListener('click', function() {
        modalTitle.textContent = 'Add Training Schedule';
        trainingForm.action = this.dataset.action;
        formMethod.value = "POST";
        scheduleId.value = "";
        studentId.value = "";
        trainingId.value = "";
        optInAt.value = "";
        optOutAt.value = "";
        modal.classList.remove('hidden');
    });

    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            modalTitle.textContent = 'Edit Training Schedule';
            trainingForm.action = this.dataset.action;
            formMethod.value = "PUT";
            scheduleId.value = this.dataset.id;
            studentId.value = this.dataset.student_id;
            trainingId.value = this.dataset.training_id;
            optInAt.value = this.dataset.opt_in_at.split(' ')[1];
            optOutAt.value = this.dataset.opt_out_at.split(' ')[1];
            modal.classList.remove('hidden');
        });
    });

    closeModal.addEventListener('click', function() {
        modal.classList.add('hidden');
    });
});
</script>

@endsection
