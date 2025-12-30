<div class="overflow-x-auto">
<table class="w-full border border-gray-300 border-collapse">

    <thead class="bg-gray-200">
        <tr>
            <th class="p-3 text-left">Name</th>
            <th class="p-3 text-center">Age</th>
            <th class="p-3 text-center">Mark</th>
            <th class="p-3 text-center">Result</th>
            <th class="p-3 text-center">Action</th>
        </tr>
    </thead>

    <tbody>
    @forelse($students as $student)
        <tr class="border-t hover:bg-gray-50">

            <td class="p-3 text-left">
                {{ $student->name }}
            </td>

            <td class="p-3 text-center">
                {{ $student->age }}
            </td>

            <td class="p-3 text-center">
                {{ $student->mark }}
            </td>

            <td class="p-3 text-center">
                <span class="px-2 py-1 rounded text-sm font-semibold
                {{ $student->result == 'Pass' ? 'text-green-600' : 'text-red-600' }}">
                    {{ $student->result }}
                </span>
            </td>

            <td class="p-3 text-center">
                <div class="inline-flex gap-2">
                    <button class="edit bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded"
                        data-id="{{ $student->id }}"
                        data-name="{{ $student->name }}"
                        data-age="{{ $student->age }}"
                        data-mark="{{ $student->mark }}">
                        Edit
                    </button>

                    <button class="delete bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded"
                        data-id="{{ $student->id }}">
                        Delete
                    </button>
                </div>
            </td>

        </tr>
    @empty
        <tr>
            <td colspan="5" class="p-4 text-center text-gray-500">
                No students found
            </td>
        </tr>
    @endforelse
    </tbody>

</table>
</div>

<div class="mt-4 pagination">
    {{ $students->links() }}
</div>
