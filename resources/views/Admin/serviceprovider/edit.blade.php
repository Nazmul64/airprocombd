@extends('Admin.master')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Service Provider</h3>
                    <a href="{{ route('serviceprovider.index') }}" class="btn btn-secondary float-right">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('serviceprovider.update', $serviceprovider->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="title">Service Title <span class="text-danger">*</span></label>
                            <input type="text"
                                   class="form-control @error('title') is-invalid @enderror"
                                   id="title"
                                   name="title"
                                   value="{{ old('title', $serviceprovider->title) }}"
                                   placeholder="e.g., VRF SYSTEM"
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="side">Position <span class="text-danger">*</span></label>
                            <select class="form-control @error('side') is-invalid @enderror"
                                    id="side"
                                    name="side"
                                    required>
                                <option value="">Select Position</option>
                                <option value="left" {{ old('side', $serviceprovider->side) == 'left' ? 'selected' : '' }}>
                                    Left Side
                                </option>
                                <option value="right" {{ old('side', $serviceprovider->side) == 'right' ? 'selected' : '' }}>
                                    Right Side
                                </option>
                            </select>
                            @error('side')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Service Items</label>
                            <div id="items-container">
                                @if($serviceprovider->items->count() > 0)
                                    @foreach($serviceprovider->items as $item)
                                        <div class="input-group mb-2 item-row">
                                            <input type="text"
                                                   class="form-control"
                                                   name="items[]"
                                                   value="{{ $item->item_name }}"
                                                   placeholder="e.g., Mini VRF">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-danger remove-item">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="input-group mb-2 item-row">
                                        <input type="text"
                                               class="form-control"
                                               name="items[]"
                                               placeholder="e.g., Mini VRF">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-danger remove-item" disabled>
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <button type="button" class="btn btn-success btn-sm" id="add-item">
                                <i class="fas fa-plus"></i> Add Item
                            </button>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Service Provider
                            </button>
                            <a href="{{ route('serviceprovider.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const itemsContainer = document.getElementById('items-container');
    const addItemBtn = document.getElementById('add-item');

    // Add new item field
    addItemBtn.addEventListener('click', function() {
        const newItem = document.createElement('div');
        newItem.className = 'input-group mb-2 item-row';
        newItem.innerHTML = `
            <input type="text"
                   class="form-control"
                   name="items[]"
                   placeholder="e.g., Cooling Only">
            <div class="input-group-append">
                <button type="button" class="btn btn-danger remove-item">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        itemsContainer.appendChild(newItem);
        updateRemoveButtons();
    });

    // Remove item field (event delegation)
    itemsContainer.addEventListener('click', function(e) {
        if (e.target.closest('.remove-item')) {
            e.target.closest('.item-row').remove();
            updateRemoveButtons();
        }
    });

    // Update remove buttons state
    function updateRemoveButtons() {
        const items = document.querySelectorAll('.item-row');
        items.forEach((item, index) => {
            const removeBtn = item.querySelector('.remove-item');
            if (items.length === 1) {
                removeBtn.disabled = true;
            } else {
                removeBtn.disabled = false;
            }
        });
    }

    updateRemoveButtons();
});
</script>
@endsection
