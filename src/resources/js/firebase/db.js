import firebase from 'firebase'
import 'firebase/firestore'

var firebaseConfig = {
    apiKey: "AIzaSyDA509a0KenvzXN_I-O6R_lib31PBO5mJA",
    authDomain: "modela-bd43e.firebaseapp.com",
    databaseURL: "https://modela-bd43e-default-rtdb.firebaseio.com",
    projectId: "modela-bd43e",
    storageBucket: "modela-bd43e.appspot.com",
    messagingSenderId: "560753544386",
    appId: "1:560753544386:web:31c7e560b3bb0a2b1b3f5b"
};
// Initialize Firebase

export const db = firebase.initializeApp(firebaseConfig).firestore();