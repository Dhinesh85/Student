@extends('welcome')

@section('content')
<div class="container mx-auto mt-5">
    <div class="flex justify-end">
        <button id="openModal" data-action="{{ route('training_schedules.store') }}" data-method="POST"
            class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
            Add Training Schedule
        </button>
    </div>
    <div class="flex justify-end mt-4">
        <div class="w-3/4">
            <table class="table-auto w-full shadow-lg rounded-lg">
                <thead>
                    <tr class="bg-gray-200 text-left">
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Course</th>
                        <th class="px-4 py-3">Start Date</th>
                        <th class="px-4 py-3">End Date</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($schedules as $schedule)
                    <tr class="bg-white hover:bg-gray-100 transition">
                        <td class="px-4 py-3">{{ $schedule->id }}</td>
                        <td class="px-4 py-3">{{ $schedule->course->name }}</td>
                        <td class="px-4 py-3">{{ $schedule->start_date }}</td>
                        <td class="px-4 py-3">{{ $schedule->end_date }}</td>
                        <td class="px-4 py-3 flex space-x-2">
                            <button class="editSchedule bg-yellow-500 text-white px-3 py-1 rounded"
                                data-id="{{ $schedule->id }}" 
                                data-course_id="{{ $schedule->course_id }}"
                                data-start_date="{{ $schedule->start_date }}"
                                data-end_date="{{ $schedule->end_date }}"
                                data-action="{{ route('training_schedules.update', $schedule->id) }}">
                                Edit
                            </button>

                            <form action="{{ route('training_schedules.destroy', $schedule->id) }}" method="POST" class="inline">
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

            <form id="trainingForm" action="" method="POST">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <input type="hidden" name="id" id="schedule_id">

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Course</label>
                    <select name="course_id" id="course_id" class="w-full border p-2 rounded-lg">
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="w-full border p-2 rounded-lg">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">End Date</label>
                    <input type="date" name="end_date" id="end_date" class="w-full border p-2 rounded-lg">
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
    const courseId = document.getElementById('course_id');
    const startDate = document.getElementById('start_date');
    const endDate = document.getElementById('end_date');
    const closeModal = document.getElementById('closeModal');
    const openModalButton = document.getElementById('openModal');
    const editButtons = document.querySelectorAll('.editSchedule');

    openModalButton.addEventListener('click', function() {
        modalTitle.textContent = 'Add Training Schedule';
        trainingForm.action = this.dataset.action;
        formMethod.value = "POST";
        scheduleId.value = "";
        courseId.value = "";
        startDate.value = "";
        endDate.value = "";
        modal.classList.remove('hidden');
    });

    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            modalTitle.textContent = 'Edit Training Schedule';
            trainingForm.action = this.dataset.action;
            formMethod.value = "PUT"; 
            scheduleId.value = this.dataset.id;
            courseId.value = this.dataset.course_id;
            startDate.value = this.dataset.start_date;
            endDate.value = this.dataset.end_date;
            modal.classList.remove('hidden');
        });
    });

    closeModal.addEventListener('click', function() {
        modal.classList.add('hidden');
    });

    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.classList.add('hidden');
        }
    });
});
</script>
@endsection
