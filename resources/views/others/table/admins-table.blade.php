<tr class="row-{{ $individual->id }}">
	<td class="id"></td>
	<td class="tb-name">{{ $individual->getNameOrUsername() }}</td>
	<td class="tb-username">{{ $individual->username }}</td>
	<td class="tb-email">{{ $individual->email }}</td>
	<td class="created_at">{{ $individual->created_at->diffForHumans() }}</td>
	<td class="updated_at">{{ $individual->updated_at->diffForHumans() }}</td>
	<td class="tb-status {{ $individual->acc_terminated ? 'terminated' : 'activated' }}">{{ $individual->acc_terminated ? 'Terminated' : 'Activated' }}</td>
	<td>
		<a type="button" class="btn btn-xs btn-info acc-login" title="Login as {{ $individual->username }}" href="{{ route('adminroles.adminlogin', ['id' => $individual->id]) }}">Login</a>
        <button type="button" class="btn btn-xs btn-primary acc-edit" title="Edit {{ $individual->username }}'s Account Details" data-toggle="modal" data-target="#editAdmin">Edit</button>
        <button type="button" class="btn btn-xs btn-{{ $individual->acc_terminated ? 'success' : 'warning' }} acc-{{ $individual->acc_terminated ? 'enable' : 'disable' }}" title="{{ $individual->acc_terminated ? 'Enable this Account' : 'Temporary disable this Account' }}">{{ $individual->acc_terminated ? 'Activate' : 'Deactivate' }}</button>
        <button type="button" class="btn btn-xs btn-danger acc-remove" title="Remove this Account" data-toggle="modal" data-target='#deleteAdmin'>Delete</button>
    </td>
    <input type="hidden" class="acc_id" value="{{ $individual->id }}">
    <input type="hidden" class="tb-first_name" value="{{ $individual->first_name }}">
    <input type="hidden" class="tb-last_name" value="{{ $individual->last_name }}">
</tr>