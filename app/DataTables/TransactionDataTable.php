<?php

namespace App\DataTables;

use App\Transaction;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TransactionDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('total_price', function($item) {
                return 'Rp '. number_format($item->total_price);
            })
            ->editColumn('user.name', function($item) {
                return ucfirst($item->user->name);
            })
            ->addColumn('action', function($item) {
                return '<a href="#" class="btn-sm btn-info"><i class="fas fa-eye"></i>Detail</a>';
            });

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Transaction $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Transaction $model)
    {
        // return $model->newQuery();
        $data = Transaction::with(['user'])->where('user_id', Auth::user()->id);
        return $this->applyScopes($data);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('transaction-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    // protected function getActionColumn($data): string
    // {
    //    return $data->id;
    // }
    protected function getColumns()
    {
        return [
            Column::make('invoice')->title('Invoice')->width(100),
            Column::make('user.name')->title('Kasir')->width(100),
            Column::make('total_price')->title('Total Harga')->width(100),
            Column::make('status')->title('status')->width(100),
            Column::computed( 'action' )
            ->exportable( FALSE )
            ->printable( FALSE )
            ->width( 60 )
            ->addClass( 'text-center' ),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Data-Transaksi_' . date('YmdHis');
    }
}
