const getMimetype = (signature) => {
  switch (signature) {
      case '89504E47':
          return 'image/png'
      case '47494638':
          return 'image/gif'
      case '25504446':
          return 'application/pdf'
      case 'FFD8FFDB':
      case 'FFD8FFE0':
          return 'image/jpeg'
      case '504B0304':
          return 'application/zip'
      default:
          return 'Unknown filetype'
  }
}

export default function(file){
  return new Promise((resolve, reject) => {
    const reader = new FileReader();

    reader.onloadend = (e) => {
      const uint = new Uint8Array(e.target.result);
      let bytes = [];
      for(let i = 0; i < 4; i++){
        bytes.push(uint[i].toString(16));
      }
      const hex = bytes.join('').toUpperCase();
      resolve(getMimetype(hex));
    };

    reader.readAsArrayBuffer(file);
  });
}