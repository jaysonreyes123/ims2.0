import axios from 'axios';
const host = window.location.hostname;
const port = host == "localhost" ? "8000" : "8082";
const axiosIns = axios.create({
    baseURL: 'http://'+host+':'+port+'/api/', 
});

// Set up a request interceptor to add the Bearer token to each request
axiosIns.interceptors.request.use(config => { 
    const bearerToken = localStorage.getItem("_token"); 
    config.headers.Authorization = `Bearer ${bearerToken}`;
    return config;
}, error => {
    return Promise.reject(error);
}); 

export default axiosIns;