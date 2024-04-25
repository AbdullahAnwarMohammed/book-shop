<div>

    <div class="container">
        <table id="example" class="table table-striped table-dark" style="width:100%">
            <thead >
                <tr>
                    <th>الاسم</th>
                    <th>رقم الهاتف</th>
                    <th>الكاش</th>
                    <th>المنطقة</th>
                    <th>عدد الكتب</th>
                    <th>بواسطة</th>
                
                </tr>
            </thead>
            <tbody>
                @foreach ($Customers as $Item)
                <tr>
                    <td>{{ $Item->name }} </td>
                    <td>{{ $Item->phone }} </td>
                    <td><span class="badge bg-{{ $Item->cash > 0 ? "success" : "danger" }}-lt"> {{  $Item->cash > 0 ? $Item->cash . " جنية" : "0"}} </span></td>
                    <td>{{ $Item->location }} </td>
                    <td>{{  $Item->purchases->count() }} </td>
                    <td><span class="badge bg-warning-lt">{{ $Item->user->name }}</span></td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>الاسم</th>
                    <th>رقم الهاتف</th>
                    <th>الكاش</th>
                    <th>المنطقة</th>
                    <th>عدد الكتب</th>
                    <th>بواسطة</th>

                </tr>
            </tfoot>
        </table>
    </div>
    
</div>
