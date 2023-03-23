<div class="modal fade" id="addGroupModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregue Miembros</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('message-groups.store') }}" method="post">
        <div class="modal-body">
          
            @csrf
            <div class="col-12 mb-3">
              <label for="">Nombre del Grupo </label>
              <input type="text" class="form-control" name="name" placeholder="Elija un nombre para el grupo">
            </div>
            <div class="col-12">
              <label for="">Seleccione nuevos Miembros</label>
              <select class="form-select selectMember" name="user_id[]" style="width: 100%" multiple>
                @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
              </select>
            </div>
         
        </div>
      
      <div class="modal-footer">
        <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit"  class="btn btn-primary">Save</button>
      </form>
      </div>
    </div>
  </div>
</div>