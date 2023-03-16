import React from "react";
import axios from "axios";


componentDidMount()
  // GET request using axios with error handling
  let path = "http://pouetlify.com/api/backup/download"

  axios.get(path)
      .then(response => this.setState({ totalReactPackages: response.data.total }))
      .catch(error => {
          this.setState({ errorMessage: error.message });
          console.error('There was an error!', error);
      });


      
      function App()
        const [data, setData] = useState([]);
      
        useEffect(() => {
          axios.get(path + "/ftp")
            .then(response => {
              setData(response.data);
            })
            .catch(error => {
              console.log(error);
            });
        }, []);