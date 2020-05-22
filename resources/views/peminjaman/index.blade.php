@extends('layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <h4>Peminjaman Buku</h4>
        <div class="box box-info">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                </p>
            </div>
            <div class="box-body">
               <table class="table table-hover">
                   <thead>
                       <tr>
                           <th>No.</th>
                           <th>Nama</th>
                           <th>Buku</th>
                           <th>Penulis</th>
                           <th>Status peminjaman</th>
                           @if(\Auth::user()->status == 1 || \Auth::user()->status == 2)
                           <th>Created_at</th>
                           <th>Action</th>
                           @endif
                       </tr>
                   </thead>
                   <tbody>
                       @foreach($data as $e=>$dt)
                       <tr>
                           <td>{{ $e+1 }}</td>
                           <td>{{ $dt->user_r->name }}</td>
                           <td>{{ $dt->buku_r->judul }}</td>
                           <td>{{ $dt->buku_r->penulis }}</td>
                           
                           @if($dt->status == 0)
                           <td><label class="label label-warning">Menunggu Verifikasi</label></td>
                           @elseif($dt->status == 1)
                           <td><label class="label label-success">Disetujui</label></td>
                           @elseif($dt->status == 2)
                           <td><label class="label label-danger">Ditolak</label></td>
                           @endif

                           @if(\Auth::user()->status == 1 || \Auth::user()->status == 2)
                           <td>{{ $dt->created_at }}</td>
                           @if($dt->status == 0)
                           <td>
                             <a href="{{ url('pinjam-buku/setujui/'.$dt->id) }}" class="btn btn-xs btn-primary btn-flat"><i class="fa fa-check"></i> Setujui</a>
                             <a href="{{ url('pinjam-buku/tolak/'.$dt->id) }}" class="btn btn-xs btn-danger btn-flat"><i class="fa"></i> Tolak</a>
                           </td>
                           @elseif($dt->status == 1)
                           <td>
                             <a href="{{ url('pinjam-buku/tolak/'.$dt->id) }}" class="btn btn-xs btn-danger btn-flat"><i class="fa"></i> Tolak</a>
                           </td>
                           @elseif($dt->status == 2)
                           <td>
                             <a href="{{ url('pinjam-buku/setujui/'.$dt->id) }}" class="btn btn-xs btn-primary btn-flat"><i class="fa fa-check"></i> Setujui</a>
                           </td>
                           @endif
                           @endif
                       </tr>
                       @endforeach
                   </tbody>
               </table>
            </div>
        </div>
    </div>
</div>
 
@endsection
 
@section('scripts')
 
<script type="text/javascript">
    $(document).ready(function(){
 
        // btn refresh
        $('.btn-refresh').click(function(e){
            e.preventDefault();
            $('.preloader').fadeIn();
            location.reload();
        })
 
    })
</script>
 
@endsection