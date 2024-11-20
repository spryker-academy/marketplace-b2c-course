import {ChangeDetectionStrategy, Component, Input, ViewEncapsulation} from '@angular/core';
import {TableConfig} from '@spryker/table';

@Component({
    selector: 'mp-customers-table',
    templateUrl: './customers-table.component.html',
    styleUrls: ['./customers-table.component.css'],
    changeDetection: ChangeDetectionStrategy.OnPush,
    encapsulation: ViewEncapsulation.None,
})
export class CustomersTableComponent {
    @Input() config: TableConfig;
    @Input() tableId?: string;

}
