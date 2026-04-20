import CallApiService from '../shared/services/callApi';
import { ENDPOINTS } from '../shared/constants/endpoints';

export class TendersService {
    static async getPublicTenders() {
        return await CallApiService.get(ENDPOINTS.TENDERS.PUBLIC);
    }
}
