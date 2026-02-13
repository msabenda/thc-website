<div class="space-y-3">
    @php
        // Works in both table columns and form view
        $record = $getRecord() ?? ($record ?? null);
    @endphp

    @if ($record && $record->receipt_path)
        <div class="text-sm font-medium text-gray-700">Payment Receipt:</div>

        <div class="flex items-center gap-3 flex-wrap">
            <a href="{{ Storage::disk('public')->url($record->receipt_path) }}"
               target="_blank"
               class="inline-flex items-center gap-2 px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg text-primary-700 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg>
                Open Receipt
            </a>

            @if (in_array(strtolower(pathinfo($record->receipt_path, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png']))
                <a href="{{ Storage::disk('public')->url($record->receipt_path) }}"
                   target="_blank"
                   class="text-sm text-blue-600 hover:underline">
                    (View image full size)
                </a>
            @endif

            <p class="text-xs text-gray-500">
                {{ basename($record->receipt_path) }} •
                {{ \Carbon\Carbon::parse($record->updated_at)->diffForHumans() }}
            </p>
        </div>

        <!-- Optional: small thumbnail preview for images -->
        @if (in_array(strtolower(pathinfo($record->receipt_path, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png']))
            <div class="mt-2 border border-gray-200 rounded-lg overflow-hidden max-w-xs">
                <img src="{{ Storage::disk('public')->url($record->receipt_path) }}"
                     alt="Receipt preview"
                     class="max-h-48 w-full object-contain">
            </div>
        @endif
    @else
        <div class="text-sm text-gray-500 italic flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            No receipt uploaded
        </div>
    @endif
</div>