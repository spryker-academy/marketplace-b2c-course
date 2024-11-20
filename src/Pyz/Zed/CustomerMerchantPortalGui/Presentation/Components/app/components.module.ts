import {NgModule} from '@angular/core';
import {WebComponentsModule} from '@spryker/web-components';

import {CustomersTableComponent} from './customers-table/customers-table.component';
import {CustomersTableModule} from './customers-table/customers-table.module';

@NgModule({
    imports: [
        WebComponentsModule.withComponents([
            CustomersTableComponent,
        ]),
        CustomersTableModule,
    ],
})
export class ComponentsModule {
}
