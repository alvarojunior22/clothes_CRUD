@props([
'type' => 'text',
'name',
'label',
'value' => '',
'required' => false
])

<div class="relative">
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        {{ $required ? 'required' : '' }}
        placeholder=" "
        class="
            peer
            w-full
            bg-white
            border border-gray-300
            rounded-lg
            px-4
            pt-6
            pb-4
            text-gray-900
            shadow-sm

            focus:outline-none
            focus:ring-2
            focus:ring-blue-500
            focus:border-blue-500
        "
    />

    <label
        class="
            absolute
            left-4
            top-4
            text-base
            text-gray-400
            bg-white
            px-1
            pointer-events-none
            transition-all

            peer-focus:-top-2
            peer-focus:text-xs
            peer-focus:text-blue-600

            peer-[&:not(:placeholder-shown)]:-top-2
            peer-[&:not(:placeholder-shown)]:text-xs
            peer-[&:not(:placeholder-shown)]:text-gray-600
        "
    >
        {{ $label }}
    </label>
</div>
