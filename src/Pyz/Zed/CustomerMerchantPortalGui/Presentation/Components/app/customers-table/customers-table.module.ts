import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {CustomersTableComponent} from './customers-table.component';
import {TableModule} from '@spryker/table';


@NgModule({
    declarations: [
        CustomersTableComponent
    ],
    imports: [
        CommonModule,
        TableModule
    ]
})
export class CustomersTableModule {
}
