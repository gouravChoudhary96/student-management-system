<!DOCTYPE html>
<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Student Management</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body class="bg-gray-100 p-6">

    <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">

        <div class="flex justify-between mb-4">
            <h2 class="text-2xl font-bold">Student Management</h2>
            <button id="addBtn" class="bg-blue-600 text-white px-4 py-2 rounded">
                + Add Student
            </button>
        </div>

        <!-- Sorting -->
        <div class="flex gap-3 mb-4">
            <select id="sort" class="border p-2 rounded">
                <option value="">Sort By</option>
                <option value="name">Name</option>
                <option value="age">Age</option>
                <option value="mark">Mark</option>
                <option value="result">Result</option>
            </select>

            <select id="direction" class="border p-2 rounded">
                <option value="asc">ASC</option>
                <option value="desc">DESC</option>
            </select>
            <button id="applySort" class="bg-gray-700 text-white px-4 rounded">
                Apply
            </button>
            
            <input
                type="text"
                id="search"
                placeholder="Search student name..."
                class="border px-3 py-2 rounded w-64" />


        </div>

        <!-- Table -->
        <div id="studentTable"></div>

    </div>

    <!-- MODAL -->
    <div id="studentModal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center">
        <div class="bg-white w-96 p-5 rounded">
            <h3 id="modalTitle" class="text-xl font-bold mb-3"></h3>

            <form id="studentForm">
                <input type="hidden" id="student_id">

                <input type="text" id="name" placeholder="Enter Name" class="border p-2 w-full mb-1">
                <span class="text-red-600 text-sm" id="error-name"></span>

                <input type="number" id="age" placeholder="Enter Age" min="1" class="border p-2 w-full mb-1">
                <span class="text-red-600 text-sm" id="error-age"></span>

                <input type="number" id="mark" min="0" placeholder="Enter Mark" max="100" class="border p-2 w-full mb-1">
                <span class="text-red-600 text-sm" id="error-mark"></span>

                <div class="flex justify-end gap-2">
                    <button type="button" id="closeModal" class="px-4 py-2 bg-gray-300 rounded">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- This is tost message -->
    <div id="toast" class="hidden fixed top-5 right-5 px-4 py-3 rounded shadow text-white"></div>

    <!-- This loader code -->
    <div id="loader"
        class="hidden fixed inset-0 bg-white/70 flex items-center justify-center z-50">
        <div class="h-10 w-10 border-4 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
    </div>

    @include('students.script')
</body>

</html>