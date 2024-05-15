<div class="mb-5 mt-5 row row-cols-1 row-cols-md-1 row-cols-xl-1 g-2 row justify-content-center">
<div class="card mb-3" style="max-width: 1540px;">
    <div class="row g-0">
      <div class="col-md-4">
        <img
          src="{{$collection->image_collection}}"
          alt="Trendy Pants and Shoes"
          class="img-fluid rounded-start"
        />
      </div>
      <div class="col-md-8">
        <div class="d-flex align-items-center mb-3">
            <img src="{{ $collection->user->image_user }}" alt="{{ $collection->user->name }}'s Image" class="img-fluid rounded-circle" style="max-width: 50px;">
            <div class="ms-3 flex-grow-1 d-flex flex-column">
                <h5 class="card-title mb-0">{{ $collection->user->name }}</h5>
                <small class="text-muted">{{ $collection->timeElapsed }}</small>
            </div>
        </div>
        <div class="card-body">
          <p class="card-text">
            {{$collection->description}}
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
