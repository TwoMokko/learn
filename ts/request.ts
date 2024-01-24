type TypeResponseError = { state: 'error', body: { 'message': string } };
type TypeResponseOk = { state: 'ok', body: any };
type TypeResponse = TypeResponseOk|TypeResponseError;

namespace Base {
    export class Request {

        public static send(formData: FormData, url: string, func?: Function): void {
            fetch(url, {
                method: 'POST',
                body: formData
            })
                .then(async response => {
                    let json = await response.json();
                    Request.response(json, func);
                     })
                .catch(response => { console.log('request failed: ' + url); console.log(response); });
        }

        private static response(response: TypeResponse, func?: Function): void {
            switch (response.state) {
                case 'ok': if (func) func(response.body); break;
                case 'error': alert(response.body.message); break;
            }
        }

        // public static send(formData: FormData, url: string, func?: Function): void {
        //     $.ajax({
        //         url				: url,
        //         method			: 'POST',
        //         dataType		: 'json',
        //         data 			: formData,
        //         contentType		: false,
        //         processData		: false,
        //         cache			: false,
        //         // beforeSend: function() { if (funcBeforeSend) funcBeforeSend(); },
        //         // complete: function() { if (funcComplete) funcComplete(); },
        //         success			: (response) => { if (func) func() },
        //         error			: (response) => { console.log('request failed: ' + url); console.log(response); }
        //     });
        // }

        // public static send(formData: FormData, url: string, func?: Function): void {
        //     let xhr = new XMLHttpRequest();
        //     xhr.open('POST', url);
        //     xhr.send(formData);
        //     xhr.onload = () => func();
        //     xhr.onerror = () => alert('Ошибка соединения');
        // }

        public static sendForm(form: HTMLFormElement, func?: Function): void {
            let url = form.getAttribute('action');
            let formData = new FormData(form);

            Request.send(formData, url, func);
        }

        public static sendData(data: { [key: string]: string|boolean|number }, url: string, func?: Function): void {
            let formData = new FormData();
            for (const key in data) {
                formData.append(key, data[key].toString());
            }

            Request.send(formData, url, func);
        }
    }
}