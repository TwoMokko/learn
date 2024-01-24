declare type TypeResponseError = {
    state: 'error';
    body: {
        'message': string;
    };
};
declare type TypeResponseOk = {
    state: 'ok';
    body: any;
};
declare type TypeResponse = TypeResponseOk | TypeResponseError;
declare namespace Base {
    class Request {
        static send(formData: FormData, url: string, func?: Function): void;
        private static response;
        static sendForm(form: HTMLFormElement, func?: Function): void;
        static sendData(data: {
            [key: string]: string | boolean | number;
        }, url: string, func?: Function): void;
    }
}
