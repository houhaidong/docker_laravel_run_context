# docker_laravel_run_context  容器化应用 php
laravel 运行环境 php 7.0 && nginx 1.11.1 &&  mariadb 10.1  && git && composer

##  启动

	docker-compose up -d

## 安装docker


	curl -sSL http://acs-public-mirror.oss-cn-hangzhou.aliyuncs.com/docker-engine/internet | sh -
	sudo mkdir -p /etc/docker
	sudo tee /etc/docker/daemon.json <<-'EOF'
	{
	  "registry-mirrors": ["https://3yf8zoyf.mirror.aliyuncs.com"]
	}
	EOF
	sudo systemctl daemon-reload
	sudo systemctl restart docker


### docker

	删除虚悬镜像
	docker rmi $(docker images -q -f dangling=true)

#### docker基础

	删除所有容器 （docker默认会阻止删除正在运行的容器）
	docker rm $(docker ps -a -q)

---

	创建一个可以 交互 终端的 容器
	docker run -i  -t  --name interactive centos

####  docker  组合（ compose ）


创建组合  - 定义 两台nginx服务器

	version: "2"
	services:
	  wordpress:
	    image: nginx
	    ports:
	      - "8080:80"
	  drupal:
	    image: nginx
	    ports:
	      - "8081:80"


---

	启动
	docker-compose  up

---

	后台启动
	docker-compose up -d

---

	查看正在运行容器
	docker ps

---

	停止组合
	docker-compose stop  (container)

---

	开启组合
	docker-compose  start (container)

---

	进入容器
	docker-compose exec wordpress bash

---

	删除组合
	docker-compose  rm  （仅仅删除容器）
	docker-compose down

---

	查看网络
	docker network  ls

---

	查看日志
	docker-compose logs  -f




### 定义网络


	version: "2"
	services:
	  wordpress:
	    image: nginx
	    ports:
	      - "8080:80"
	    networks:
	      - "public"
	  drupal:
	    image: nginx
	    ports:
	      - "8081:80"
	    networks:
	      - "public"
	  monkey:
	    image: nginx
	    ports:
	      - "8082:80"
	    networks:
	      - "default"
	networks:
	   public :
	     driver: bridge


### 挂载数据卷：



	version: "2"
	services:
	  wordpress:
	    image: nginx
	    ports:
	      - "8080:80"
	    networks:
	      - "public"
	    volumes:
	      - dbs:/mnt
	      - ./web:/usr/share/nginx/html
	  drupal:
	    image: nginx
	    ports:
	      - "8081:80"
	    networks:
	      - "public"
	    volumes:
	      - dbs:/mnt
	      - ./web:/usr/share/nginx/html
	  monkey:
	    image: nginx
	    ports:
	      - "8082:80"
	    networks:
	      - "default"
	networks:
	   public :
	     driver: bridge
	volumes:
	  dbs:
	    driver: local


####  docker  网络


	查看网络
	docker network ls

---

	调试网络
	docker   network inspact   bridge

 ---

	指定网络
	docker run  --name web_none --net none  nginx  

---

	docker-compose  进入定义services
	docker-compose exec db_center bash

#### docker 端口

	 端口转发
	 docker run --name web  -d  -p 8080:80  nginx  
	 随机公布所有端口
	 docker run --name web  -d  -P  nginx
	 随机公布端80口
	 docker run --name web  -d  -p 80  nginx


---

	查看镜像开放端口
	docker inpeat nginx

---

	查看容器端口绑定情况
	docker port web
	docker inspeat web


####   docker 网络

	创建网络
	docker   network create --driver bridge  web  

---

	查看网络
	 docker network inspact web

---

	加入容器到网络
	docker  network  connect  web web

---

	移除容器的网络
	docker network disconnect   web web

#### docker 存储


	查看所有的数据盘
	docker volume ls

---

	查看没有容器使用的数据盘
	docker  volume ls  -f  dangling=true

---


	删除数据盘
	docker volume rm db

---

	调试数据盘
	docker volume  inspect db

---

	删除容器并且一起删除数据盘
	docker rm  -v  container

---

	创建存储容器
	docker  create -v /mnt --name  dbcenter  centos

---

	   --volumes-from 绑定存储容器
	   docker run -it --name center1 --volumes-from dbcenter centos bash

---

	随机存储位置  -v
	docker run  -v /mnt  --name db  centos

---

	指定存储  -v
	docker run  -v   /User/cailei/Code/docker:/mnt  --name db  centos
