export default {

  globalLoading: (state) => state.globalLoading,
  getError: (state) => state.error,
  getErrorIndex: (state) => {
    const errorList = ['000', 100, 101, 102, 200, 201, 202, 203, 204, 205, 206, 207, 208, 226, 300, 301, 302, 303, 304, 305, 307, 308, 400, 401, 402, 403, 404, 405, 406, 407, 408, 409, 410, 411, 412, 413, 414, 415, 416, 417, 418, 419, 421, 422, 423, 424, 426, 428, 429, 431, 444, 451, 499, 500, 501, 502, 503, 504, 505, 506, 507, 508, 510, 511, 599];

    const { error } = state;
    let statusCode = error.response ? error.response.status : null;

    if (!statusCode) {
      statusCode = '000';
    }
    const errorIndex = errorList.indexOf(statusCode);
    return errorIndex;
  },
};
