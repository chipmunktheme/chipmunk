const Http = {
  post(url, data) {
    return new Promise((resolve, reject) => {
      const xhr = new XMLHttpRequest();
      xhr.open('POST', url, true);

      xhr.onload = () => {
        if (xhr.status === 200) {
          if (xhr.response) {
            const response = JSON.parse(xhr.response);

            if (response.success) {
              resolve(response.data);
            } else {
              reject(response.data);
            }
          }
        } else {
          reject(xhr.statusText);
        }
      };

      xhr.onerror = () => {
        reject('Network error');
      };

      xhr.send(data);
    });
  },
};

export default Http;
