@extends('admin.app')

@section('content')
    <section class="content container-fluid  my-1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <div class="rep-list bg-white py-3 px-2 overflow-auto">
            <button type="button" class="btn btn-primary btn-modal mb-3" data-toggle="modal"
                data-target="#addrep-list-Modal" data-whatever="@getbootstrap"><span>Add Rep/Influencer</span><img
                    src="/images.add.png" alt="">
            </button>
            <div class="modal fade bd-example-modal-lg mt-5" id="addrep-list-Modal" tabindex="-1" role="dialog"
                aria-labelledby="addrep-list-ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addrep-list-Label">Add Rep/Influencer List</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="add_new_rep">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Type:</label>
                                            <select class="form-control" type="text" id='rep_type'>
                                                <option value="Respresentative">Respresentative</option>
                                                <option value="Influencer">Influencer</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Name of
                                                Representative/Influencer
                                            </label>
                                            <input type="text" id="rep_name" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Country:</label>
                                            <input type="text" id="rep_country" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">City Area:</label>
                                            <input type="text" id="rep_city" class="form-control">
                                        </div>
                                    </div>


                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Rep Email
                                            </label>
                                            <input type="email" id="rep_email" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Rep Phone
                                            </label>
                                            <input type="text" id="rep_phone" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>

                    </div>
                    </form>
                </div>
            </div>
            <table class="datatable-pagination table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Name of Rep/Influencer </th>
                        <th>Type</th>
                        <th>Country</th>
                        <th>City/Area</th>
                        <th>E-mail</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_reps as $rep)
                        <tr>
                            <td><a href="{{ route('admin.rep.details', $rep->id) }}"> {{ $rep->name }} </a></td>
                            <td>{{ $rep->type }}</td>
                            <td>{{ $rep->country }}</td>
                            <td>{{ $rep->city }}</td>
                            <td class="center transform-none">{{ $rep->email }}</td>
                            <td><a class="nav-link" href="{{ route('admin.delete.rep', $rep->id) }}"
                                    onclick="return confirm('Are you sure you want to delete this representative?');"
                                    aria-controls="documents" aria-selected="true"><i class="fas fa-trash-alt"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </section>
@endsection
