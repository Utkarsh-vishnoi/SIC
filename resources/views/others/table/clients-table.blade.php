<tr class="row-{{ $individual->id }}">
	<td class="id"></td>
	<td class="tb-username">{{ $individual->username }}</td>
	<td class="created_at">{{ $individual->created_at->diffForHumans() }}</td>
	<td class="updated_at">{{ $individual->updated_at->diffForHumans() }}</td>
	<td class="tb-status {{ $individual->acc_terminated ? 'terminated' : 'activated' }}">{{ $individual->acc_terminated ? 'Terminated' : 'Activated' }}</td>
	<td>
		<a type="button" class="btn btn-xs btn-info acc-login" title="Login as {{ $individual->username }}" href="{{ route('adminroles.clientlogin', ['id' => $individual->id]) }}">Login</a>
        <button type="button" class="btn btn-xs btn-primary acc-edit" title="Edit {{ $individual->username }}'s Account Details" data-toggle="modal" data-target="#editClient">Edit</button>
        <button type="button" class="btn btn-xs btn-{{ $individual->acc_terminated ? 'success' : 'warning' }} acc-{{ $individual->acc_terminated ? 'enable' : 'disable' }}" title="{{ $individual->acc_terminated ? 'Enable this Account' : 'Temporary disable this Account' }}">{{ $individual->acc_terminated ? 'Activate' : 'Deactivate' }}</button>
        <button type="button" class="btn btn-xs btn-danger acc-remove" title="Remove this Account" data-toggle="modal" data-target='#deleteClient'>Delete</button>
    </td>
    <input type="hidden" class="acc_id" value="{{ $individual->id }}">
</tr>