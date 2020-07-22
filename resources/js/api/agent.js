// import { IProfile, IPhoto } from './../models/profile';
// import { history } from './../../index';
// import { IActivity, IActivitiesEnvelope } from './../models/activity';
// import axios, { AxiosResponse } from 'axios';
// import {toast} from 'react-toastify'
// import { IUser, IUserFormValues } from '../models/user';

import axios from "axios";


axios.defaults.baseURL ='/api';


// axios.interceptors.request.use((config) => {
//     const token = window.localStorage.getItem('jwt');
//     if (token) config.headers.Authorization = `Bearer ${token}`;
//     return config;
// }, error => {
//     return Promise.reject(error);
// })


// axios.interceptors.response.use(undefined, error => {
   
//     if (error.message === 'Network Error' && !error.response) {
//         toast.error('Network error - make sure API is running!')
//     }
//     const {status, data, config,headers} = error.response;
//     if (status === 404) {
//         history.push('/notfound')
//     }
//     if (status === 401 && headers['www-authenticate'] === 'Bearer error="invalid_token", error_description="The token is expired"') {
//         window.localStorage.removeItem('jwt');
//         history.push('/')
//         toast.info('Your session has expired, please login again')
//       }
//     if (status === 400 && config.method === 'get' && data.errors.hasOwnProperty('id')) {
//         history.push('/notfound')
//     }
//     if (status === 500) {
//         toast.error('Server error - check the terminal for more info!')
//     }
//     throw error.response;
// })

const responseBody = (response)=>response.data;


const requests = {
    get: (url)=> axios.get(url).then(responseBody),
    post: (url,body)=> axios.post(url,body).then(responseBody),
    put: (url,body)=> axios.put(url,body).then(responseBody),
    del: (url)=> axios.delete(url).then(responseBody),
}

// const Activities = {
//     list: (params: URLSearchParams): Promise<IActivitiesEnvelope> =>
//       axios.get('/activities', {params: params}).then(responseBody),
//     details: (id: string) => requests.get(`/activities/${id}`),
//     create: (activity: IActivity) => requests.post('/activities', activity),
//     update: (activity: IActivity) =>
//       requests.put(`/activities/${activity.id}`, activity),
//     delete: (id: string) => requests.del(`/activities/${id}`),
//     attend: (id: string) => requests.post(`/activities/${id}/attend`, {}),
//     unattend: (id: string) => requests.del(`/activities/${id}/attend`)
//   };

const User = {
    // current: (): Promise<IUser> => requests.get('/user'),
    login: (user) => requests.post(`/auth/login`, user),
    register: (user) => requests.post(`/auth/register`, user),
}

// const Profiles = {
//     get: (username: string): Promise<IProfile> => requests.get(`/profiles/${username}`),
//     uploadPhoto: (photo: Blob): Promise<IPhoto> => requests.postForm(`/photos`, photo),
//     setMainPhoto: (id: string) => requests.post(`/photos/${id}/setMain`, {}),
//     deletePhoto: (id: string) => requests.del(`/photos/${id}`),
//     updateProfile: (profile: Partial<IProfile>) => requests.put(`/profiles`, profile),
//     follow: (username: string) => requests.post(`/profiles/${username}/follow`, {}),
//     unfollow: (username: string) => requests.del(`/profiles/${username}/follow`),
//     listFollowings: (username: string, predicate: string) => requests.get(`/profiles/${username}/follow?predicate=${predicate}`),
//     listActivities: (username: string, predicate: string) =>
//     requests.get(`/profiles/${username}/activities?predicate=${predicate}`)
// }

export default {
    // Activities,
    User,
    // Profiles
}