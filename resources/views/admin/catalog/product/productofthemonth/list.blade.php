@extends('admin.layout.master')
@section('content')
<div class="wrapper">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading ">
                    Product Of The Month List
                    <span class="tools pull-right">
                        <a class="fa fa-repeat box-refresh" href="javascript:;"></a>
                        <a class="t-close fa fa-times" href="javascript:;"></a>
                    </span>
                </header>
                <table class="table responsive-data-table data-table">
                    <thead>
                        <tr>
                            <th width="30px">Id</th>
                            <th width="80">Date</th>
                            <th width="60">Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Offer Price</th>
                            <th>Category</th>
                            <th>Expire Date</th>
                            <th>Expire Time</th>
                            <th width="70px">Custom</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ProductOfTheMonths as $ProductOfTheMonth)
                       
                            <tr>
                                <td>{{ $ProductOfTheMonth->product->id }}</td>
                                <td>{{ $ProductOfTheMonth->created_at }}</td>
                                <td><img src="{{ route('front.product.image.get',['50','50','80',$ProductOfTheMonth->product->image->first()->name]) }}"></td>
                                <td>{{ $ProductOfTheMonth->product->name }}</td>
                                <td>{{ $ProductOfTheMonth->product->mrp }}</td>
                                <td>{{ $ProductOfTheMonth->msp }}</td>
                                <td>@foreach($ProductOfTheMonth->product->category as $key=>$ProductOnCategory) {{ ($key==0)?'':', ' }}{{ App\Model\Catalog\Category::find($ProductOnCategory->cid)->name }}  @endforeach</td>
                                <td>{{ date('d-m-Y',strtotime($ProductOfTheMonth->expire)) }}</td>
                                <td>{{ date('h:i',strtotime($ProductOfTheMonth->expire)) }}</td>
                                <td>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
        </div>

    </div>
</div>
   
                   

@endsection
