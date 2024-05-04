@if(!$user->trashed())

<div class="modal fade" id="deactivate-user{{ $user->id}}">
 <div class="modal-dialog">
    <div class="modal-content border-danger">
        <div class="modal header border-danger">
          <h4 class="h5 text-danger modal-title"><i class="fa-solid fa-user-slash">Deactivate User</i></h4>
        </div>
        <div class="modal-body">
              Are you sure you want to deactivate
              @if($user->avatar)
              <img src="{{ $user->avatar}}" alt="" class="rounded-circle avatar-sm d-inline">
              @else
               <i class="fa-solid fa-circle-user icon-sm text-secondary align-middle"></i>
              @endif
              {{ $user->name }}?
        </div>
        <div class="modal-footer border-0">
            <form action="{{ route('admin.users.deactivate',$user->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button type="button" data-bs-dismiss="modal" class="btn-outline-danger btn btn-sm">Cancel</button>
                <button type="submit" class="btn btn-sm btn-danger">Deactivate</button>
            </form>

        </div>

    </div>
 </div>

</div>

@else
 {{--ACTIVAte--}}
<div class="modal fade" id="activate-user{{ $user->id}}">
    <div class="modal-dialog">
       <div class="modal-content border-success">
           <div class="modal header border-success">
             <h4 class="h5 text-success modal-title"><i class="fa-solid fa-user-check">Activate User</i></h4>
           </div>
           <div class="modal-body">
                 Are you sure you want to activate
                 @if($user->avatar)
                 <img src="{{ $user->avatar}}" alt="" class="rounded-circle avatar-sm d-inline">
                 @else
                  <i class="fa-solid fa-circle-user icon-sm text-secondary align-middle"></i>
                 @endif
                 {{ $user->name }}?
           </div>
           <div class="modal-footer border-0">
               <form action="{{ route('admin.users.activate', $user->id)}}" method="post">
                   @csrf
                   @method('PATCH')
                   <button type="button" data-bs-dismiss="modal" class="btn-outline-success btn btn-sm">Cancel</button>
                   <button type="submit" class="btn btn-sm btn-success">Activate</button>
               </form>
   
           </div>
   
       </div>
    </div>
   
   </div>

@endif