@extends('welcome')

@section('content')
<div class="container mx-auto mt-5">
    <div class="flex justify-end">
        <button id="openModal" data-action="{{ route('students.store') }}" data-method="POST"
            class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
            Add Student
        </button>
    </div>
    <div class="flex justify-end mt-4">
        <div class="w-3/4">
            <table class="table-auto w-full shadow-lg rounded-lg">
                <thead>
                <tr class="bg-gray-200 text-left">
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Image</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Phone</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                    <tr class="bg-white hover:bg-gray-100 transition">
                        <td class="px-4 py-3">{{ $student->id }}</td>
                        <td class="px-4 py-3">
                            @if ($student->image)
                            <img src="{{ asset('storage/' . $student->image) }}" alt="Student Image" class="w-16 h-16 rounded-full">
                            @else
                            <span>No Image</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">{{ $student->name }}</td>
                        <td class="px-4 py-3">{{ $student->email }}</td>
                        <td class="px-4 py-3">{{ $student->phone }}</td>
                        <td class="px-4 py-3 flex space-x-2">
                            <button class="editStudent bg-yellow-500 text-white px-3 py-1 rounded"
                                data-id="{{ $student->id }}" data-name="{{ $student->name }}"
                                data-email="{{ $student->email }}" data-phone="{{ $student->phone }}"
                                data-image="{{ asset('storage/' . $student->image) }}"
                                data-action="{{ route('students.update', $student->id) }}">
                                Edit
                            </button>

                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="inline">
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
            <!-- Add/Edit Student Modal -->
            <div id="studentModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
                <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                    <div class="flex justify-between items-center">
                        <h3 id="modalTitle" class="text-lg font-semibold">Add New Student</h3>
                        <button id="closeModal" class="text-gray-500 hover:text-gray-700">&times;</button>
                    </div>

                    <form id="studentForm" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" id="formMethod" value="POST">
                        <input type="hidden" name="id" id="student_id">

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Profile Picture</label>
                            <input type="file" name="image" id="profileImage" class="w-full border p-2 rounded-lg">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name" id="student_name" class="w-full border p-2 rounded-lg">
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="student_email" class="w-full border p-2 rounded-lg">
                            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Phone</label>
                            <input type="text" name="phone" id="student_phone" class="w-full border p-2 rounded-lg">
                            @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex justify-end space-x-2">
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Save Student</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const modal = document.getElementById('studentModal');
                const modalTitle = document.getElementById('modalTitle');
                const studentForm = document.getElementById('studentForm');
                const formMethod = document.getElementById('formMethod');
                const studentId = document.getElementById('student_id');
                const studentName = document.getElementById('student_name');
                const studentEmail = document.getElementById('student_email');
                const studentPhone = document.getElementById('student_phone');
                const closeModal = document.getElementById('closeModal');
                const openModalButton = document.getElementById('openModal');
                const editButtons = document.querySelectorAll('.editStudent');


                openModalButton.addEventListener('click', function() {
                    modalTitle.textContent = 'Add New Student';
                    studentForm.action = this.dataset.action;
                    formMethod.value = "POST";
                    studentId.value = "";
                    studentName.value = "";
                    studentEmail.value = "";
                    studentPhone.value = "";
                    modal.classList.remove('hidden');
                });


                editButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        modalTitle.textContent = 'Edit Student';
                        studentForm.action = this.dataset.action;
                        formMethod.value = "PUT";
                        studentId.value = this.dataset.id;
                        studentName.value = this.dataset.name;
                        studentEmail.value = this.dataset.email;
                        studentPhone.value = this.dataset.phone;
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