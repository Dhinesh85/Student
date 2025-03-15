@extends('welcome')

@section('content')
<div class="container mx-auto mt-5">
    <div class="flex justify-end">
        <button id="openModal" data-action="{{ route('courses.store') }}" data-method="POST"
            class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
            Add Course
        </button>
    </div>

    <div class="flex justify-end mt-4">
        <div class="w-3/4">
            <table class="table-auto w-full shadow-lg rounded-lg">
                <thead>
                    <tr class="bg-gray-200 text-left">
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Description</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                        <tr class="bg-white hover:bg-gray-100 transition">
                            <td class="px-4 py-3">{{ $course->name }}</td>
                            <td class="px-4 py-3">{{ $course->description }}</td>
                            <td class="px-4 py-3 flex space-x-2">
                                <button class="editCourse bg-yellow-500 text-white px-3 py-1 rounded-lg"
                                    data-id="{{ $course->id }}"
                                    data-name="{{ $course->name }}"
                                    data-description="{{ $course->description }}"
                                    data-action="{{ route('courses.update', $course->id) }}">
                                    Edit
                                </button>
                                <form action="{{ route('courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-lg">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add/Edit Course Modal -->
<div id="courseModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
        <h3 id="modalTitle" class="text-lg font-semibold mb-4">Add New Course</h3>
        <form id="courseForm" method="POST">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">
            <input type="hidden" name="course_id" id="course_id">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Course Name</label>
                <input type="text" name="name" id="course_name" class="w-full border p-2 rounded-lg" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="course_description" class="w-full border p-2 rounded-lg"></textarea>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" id="closeModal" class="px-4 py-2 bg-gray-400 rounded-lg">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const modal = document.getElementById('courseModal');
        const modalTitle = document.getElementById('modalTitle');
        const courseForm = document.getElementById('courseForm');
        const formMethod = document.getElementById('formMethod');
        const courseId = document.getElementById('course_id');
        const courseName = document.getElementById('course_name');
        const courseDescription = document.getElementById('course_description');
        const closeModal = document.getElementById('closeModal');
        const openModalButton = document.getElementById('openModal');
        const editButtons = document.querySelectorAll('.editCourse');

       
        openModalButton.addEventListener('click', function() {
            modalTitle.textContent = 'Add New Course';
            courseForm.action = this.dataset.action;
            formMethod.value = "POST";
            courseId.value = "";
            courseName.value = "";
            courseDescription.value = "";
            modal.classList.remove('hidden');
        });

        
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                modalTitle.textContent = 'Edit Course';
                courseForm.action = this.dataset.action;
                formMethod.value = "PUT";
                courseId.value = this.dataset.id;
                courseName.value = this.dataset.name;
                courseDescription.value = this.dataset.description;
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
