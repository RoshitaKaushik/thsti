import CallApiService from '../shared/services/callApi';
import { ENDPOINTS } from '../shared/constants/endpoints';

export class NewsService {
    static async getPublicNews() {
        return await CallApiService.get(ENDPOINTS.NEWS.PUBLIC);
    }
}
