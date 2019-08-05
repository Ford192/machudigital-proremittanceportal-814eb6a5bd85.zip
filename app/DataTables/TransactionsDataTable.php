<?php

namespace App\DataTables;

use App\Transaction;
use App\User;
use Yajra\DataTables\Services\DataTable;

class TransactionsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {

        return datatables($query)->editColumn('created_at', '{!! $created_at !!}')
            ->addColumn('branch',function ($query) {
                $transaction = Transaction::find($query->id);
                $agent = User::find($transaction->bank_officer);

                return $agent->bank_branch;
            })->addColumn('teller',function ($query){
                $transaction = Transaction::find($query->id);
                $agent = User::find($transaction->bank_officer);

                return $agent->name;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Transaction $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Transaction $model)
    {
        return $model->newQuery()->select('id','transaction_id','rec_name','rec_id_type', 'rec_id_number','rec_dob', 's_name', 's_location','amount', 'purpose','mobile_account', 'bank_officer','created_at');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
//                    ->addAction(['width' => '80px'])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
//            ['name' => 'id', 'data' => 'id', 'title'=> '#', "className" => "text-center"],
            ['name' => 'transaction_id', 'data' => 'transaction_id', 'title'=> 'instntnmny id', "className" => "text-center"],
            ['name' => 'rec_name', 'data' => 'rec_name', 'title'=> 'Receiver Name', "className" => "text-center"],
            ['name' => 'rec_id_type', 'data' => 'rec_id_type', 'title'=> 'Receiver ID Type', "className" => "text-center"],
            ['name' => 'mobile_account', 'data' => 'mobile_account', 'title'=> 'Receiver Phone', "className" => "text-center"],
            ['name' => 'rec_id_number', 'data' => 'rec_id_number', 'title'=> 'Receiver ID Number', "className" => "text-center"],
            ['name' => 'rec_dob', 'data' => 'rec_dob', 'title'=> 'Receiver Date Of Birth', "className" => "text-center"],
            ['name' => 's_name', 'data' => 's_name', 'title'=> 'Sender Name', "className" => "text-center"],
            ['name' => 's_location', 'data' => 's_location', 'title'=> 'Sender Country', "className" => "text-center"],
            ['name' => 'amount', 'data' => 'amount', 'title'=> 'Amount (GHS)', "className" => "text-center"],
            ['name' => 'purpose', 'data' => 'purpose', 'title'=> 'Transfer Purpose', "className" => "text-center"],
            ['name' => 'teller', 'data' => 'teller', 'title'=> 'Teller', "className" => "text-center"],
            ['name' => 'branch', 'data' => 'branch', 'title'=> 'Branch', "className" => "text-center"],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Transactions_' . date('YmdHis');
    }
}
