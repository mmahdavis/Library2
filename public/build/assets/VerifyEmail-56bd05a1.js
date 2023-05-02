import{v as g,l as _,e as r,b as e,u as t,w as o,F as h,o as l,X as p,f as y,a as s,n as v,g as n,z as u,k as x}from"./app-5ae7d91e.js";import{A as b,_ as k}from"./AuthenticationCardLogo-328a6ebe.js";import{_ as w}from"./PrimaryButton-f090074d.js";const V=s("div",{class:"mb-4 text-sm text-gray-600"}," Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another. ",-1),E={key:0,class:"mb-4 font-medium text-sm text-green-600"},B=["onSubmit"],C={class:"mt-4 flex items-center justify-between"},z={__name:"VerifyEmail",props:{status:String},setup(c){const d=c,i=g({}),f=()=>{i.post(route("verification.send"))},m=_(()=>d.status==="verification-link-sent");return(a,N)=>(l(),r(h,null,[e(t(p),{title:"Email Verification"}),e(b,null,{logo:o(()=>[e(k)]),default:o(()=>[V,t(m)?(l(),r("div",E," A new verification link has been sent to the email address you provided in your profile settings. ")):y("",!0),s("form",{onSubmit:x(f,["prevent"])},[s("div",C,[e(w,{class:v({"opacity-25":t(i).processing}),disabled:t(i).processing},{default:o(()=>[n(" Resend Verification Email ")]),_:1},8,["class","disabled"]),s("div",null,[e(t(u),{href:a.route("profile.show"),class:"underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"},{default:o(()=>[n(" Edit Profile")]),_:1},8,["href"]),e(t(u),{href:a.route("logout"),method:"post",as:"button",class:"underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ml-2"},{default:o(()=>[n(" Log Out ")]),_:1},8,["href"])])])],40,B)]),_:1})],64))}};export{z as default};
