import axios from 'axios';

class Weather {
    async conditions(city, apiKey) {
        const response = await this.performQuery(city, apiKey);

        return response.data;
    }

    async performQuery(city, apiKey) {
        const endpoint = `https://api.openweathermap.org/data/2.5/weather?q=${city}&units=metric&APPID=${apiKey}`;

        return await axios.get(endpoint);
    }
}

export default new Weather();
